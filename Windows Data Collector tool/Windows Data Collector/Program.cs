using System.Diagnostics;
using System;
using System.Net.NetworkInformation;
using System.Text.RegularExpressions;
using System.Net.Http;
using System.Collections.Generic;
using System.Threading.Tasks.Dataflow;

var encrypted = "";
static string executeCmd(String command, String args)
{
    String stringOut = "";
    try
    {
        ProcessStartInfo start = new ProcessStartInfo();
        start.FileName = command;
        start.Arguments = args;
        start.UseShellExecute = false;
        start.RedirectStandardOutput = true;
        start.CreateNoWindow = true;
        Process process = Process.Start(start);
        stringOut = process.StandardOutput.ReadToEnd();
        return stringOut;
    }
    catch (Exception e)
    {
        return e.ToString();
    }


}

String cmdOutput = executeCmd("systeminfo", "");


String uuidOutput = executeCmd("wmic", "csproduct get uuid");



String macOutput = executeCmd("getmac", "");



List<String> cmdList = new List<String>();
List<String> temp = new List<string>();
foreach (String line in Regex.Split(cmdOutput, @"[\t\b\r\n]"))
{
    String edit;
    edit = Regex.Replace(line, @"[ \t]{2,}", "");
    cmdList.Add(edit);
}
foreach (String line in Regex.Split(uuidOutput, @"[\t\b\r\n]"))
{
    String edit;
    edit = Regex.Replace(line, @"[ \t]{2,}", "");
    temp.Add(edit);
}
String uuid = temp[3];


List<List<String>> sysInfo = new List<List<String>>();

foreach (String line in cmdList)
{
    var info = Regex.Split(line, @"[:]");
    List<String> list = new List<String>();
    list.Add(info[0]);
    try
    {
        list.Add(info[1]);
    }
    catch (Exception e)
    {
    }
    sysInfo.Add(list);
}

static async void sendData(List<List<String>> sysInfo, string encrypted, string uuid)
{
    String host;
    String ID;
    String bootTime;
    String encryption;
    String uuid_def;
    HttpClient send = new();
    var data = new Dictionary<string, string>
    {
        {"model", sysInfo[12][1]},
        {"host_name", sysInfo[2][1]},
        {"product_id", sysInfo[18][1]},
        {"last_boot_time", sysInfo[22][1]},
        {"encryption_status", encrypted},
        {"uuid", uuid}
    };
    var content = new FormUrlEncodedContent(data);

    var response = send.PostAsync("http://localhost/api/add", content);

    if (response.IsCompletedSuccessfully) {
        Console.WriteLine("Success");
    }

    else {
        Console.WriteLine(response.Result.StatusCode.ToString());
        Console.WriteLine("Failed");
    }


}




static string GetBitLockerStatus(string encrypted)
{
    Process process = new Process();
    process.StartInfo.FileName = "powershell.exe";
    process.StartInfo.Arguments = "-command (New-Object -ComObject Shell.Application).NameSpace('C:').Self.ExtendedProperty('System.Volume.BitLockerProtection')";
    process.StartInfo.UseShellExecute = false;
    process.StartInfo.RedirectStandardOutput = true;
    process.Start();
    StreamReader reader = process.StandardOutput;
    string output = reader.ReadToEnd().Substring(0, 1); //needed as output would otherwise be 1\r\n (if encrypted)
    Console.WriteLine(output);
    process.WaitForExit();
    var result = Convert.ToInt32(output);
    switch (result)
    {
        case 0:
            encrypted = "Not Encrypted";
            break;
        case 1:
            encrypted = "Encrypted";
            break;
        case 2:
            encrypted = "Encryption In Progress";
            break;
        case 3:
            encrypted = "Decryption In Progress";
            break;
        case 4:
            encrypted = "Encryption Paused";
            break;
        case 5:
            encrypted = "Decryption Paused";
            break;
        case 6:
            encrypted = "Encryption Suspended";
            break;
        case 7:
            encrypted = "Decryption Suspended";
            break;
        case 8:
            encrypted = "Encryption Stopped";
            break;
        case 9:
            encrypted = "Decryption Stopped";
            break;

    }
    
    return encrypted;
}
encrypted = GetBitLockerStatus(encrypted);

sendData(sysInfo, encrypted, uuid);

Console.WriteLine(encrypted);
/*
PowerShell powershell = PowerShell.Create();
powershell.AddScript("manage-bde -status");

foreach (PSObject result in powershell.Invoke())
{
    Console.WriteLine(result);
}
*/