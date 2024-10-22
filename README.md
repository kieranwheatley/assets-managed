
# About Assets? Managed.

Assets? Managed. is an asset management application which focuses on blending the business efficiency focuses of IT Asset Management and the risk detection and prevention focus of Information Security Management Systems. By using this tool, organisations can get a clear overview of all their assets with information allowing them to be tracked through their entire lifecycle. The tool also check for known vulnerabilities using the NIST Vulnerability API and has a Windows Data Collection tool. This tool can be installed on end-user devices and, when ran (ideally on boot), will automatically report compliance data about the device including: last boot time and the disk encryption status.

### Screenshot showing the application dashboard:
![Assets Managed - Dashboard](https://github.com/kieranwheatley/assets-managed/assets/56694341/c1953913-4b45-4e29-a5fc-cf2e7128693d)

### Screenshot showing the 3D asset map, which identifies locations which contains assets with potential security risks:
![Assets Managed - Map](https://github.com/kieranwheatley/assets-managed/assets/56694341/8d466c49-f215-4611-b132-285f24c27d0b)

### Screenshot showing the (mock) hardware records table:
![Assets Managed - Hardware](https://github.com/kieranwheatley/assets-managed/assets/56694341/41759a71-4bb0-4831-9227-471f370dbc13)


## Project Management

The agile methodology is being used for project management during the development of this application. Notion is being used to provide a kanban board as well as the GANTT chart.

### Project Aim
The project aim was to develop an application to help combine asset management aims and provide organisations a platform for storing assets with automated data collection to check ISM compliance, detect vulnerabilities, and maximise asset’s value through its lifecycle.

### Project Objectives
The objectives of this project set out to achieve the aim were:

- Develop a full-stack application asset management system.

- Ensure the application is a single source of truth.

- Automatically collect data from assets to keep information up-to date.

- Detect vulnerabilities in assets so they can be resolved.

## Technologies Used

* Laravel (PHP)
* MySQL
* Docker
* CSS
* JavaScript
* C#

## Acknowledgements

- **[Dr Hafizul Asad](https://www.plymouth.ac.uk/staff/hafizul-asad)** - Project supervisor
- **[Laravel LLC](https://laravel.com/)** - Developers of the Laravel framework
- **[Colorlib](https://colorlib.com/)** - Creator of AdminLTE3 template
- **[Jeroen Noten](https://github.com/jeroennoten)** - Created the AdminLTE3 laravel integration, used for the web application
- **[Enlightn Software.](https://www.laravel-enlightn.com/)** - Tool used for checking security, performance, and reliability 
- **[National Institute of Standards and Technology](https://www.nist.gov/)** - Utilising the NIST vulnerability API
- **[Mapbox](https://www.mapbox.com/)** - Implemented Mapbox for displaying asset locations on a map
- **[Chart.js](https://www.chartjs.org/)** - Used for data visualisation

## Installation

Please note if you install this application, you will need to get an API key from <https://www.mapbox.com/> which must be placed in your .ENV file in the ```MAPBOX_TOKEN field```. Without this, the assets map will not work.

## Security Vulnerabilities

If you discover a security vulnerability within this application, please open an issue with as much detail as possible. All security vulnerabilities will be promptly addressed.

## License

Assets? Managed. is licensed under a [Creative Commons Attribution 4.0 International License][cc-by].

[![CC BY 4.0][cc-by-shield]][cc-by]

[cc-by]: http://creativecommons.org/licenses/by/4.0/
[cc-by-shield]: https://img.shields.io/badge/License-CC%20BY%204.0-lightgrey.svg
