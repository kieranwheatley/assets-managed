using System.Diagnostics;
using System;
using System.Net.NetworkInformation;
using System.Text.RegularExpressions;
using System.Net.Http;
using System.Collections.Generic;

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
List<String> cmdList = new List<String>();
foreach (String line in Regex.Split(cmdOutput, @"[\t\b\r\n]"))
{
    String edit;
    edit = Regex.Replace(line, @"[ \t]{2,}", "");
    cmdList.Add(edit);
}

cmdList = cmdList.Where(s => !string.IsNullOrEmpty(s)).Distinct().ToList();

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

static async void sendData(List<List<String>> sysInfo, string encrypted)
{
    HttpClient send = new();
    var data = new Dictionary<string, string>
    {
        {"model", sysInfo[12][1]},
        {"host_name", sysInfo[0][1]},
        {"product_id", sysInfo[8][1]},
        {"last_boot_time", sysInfo[10][1]},
        {"encryption_status", encrypted}
    };
    var content = new FormUrlEncodedContent(data);

    var response = send.PostAsync("http://localhost/api/add", content);

    if (response.IsCompletedSuccessfully)
    {
        Console.WriteLine();
    }

    else
    {
        Console.WriteLine(response.Result.StatusCode.ToString());
        Console.WriteLine();
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

sendData(sysInfo, encrypted);

Console.WriteLine(encrypted);
/*
PowerShell powershell = PowerShell.Create();
powershell.AddScript("manage-bde -status");

foreach (PSObject result in powershell.Invoke())
{
    Console.WriteLine(result);
}
*/