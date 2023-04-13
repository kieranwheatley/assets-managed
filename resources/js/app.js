import './bootstrap';

import {
    Chart as ChartJS,
    ArcElement,
    Tooltip,
    Legend
} from 'chart.js';

import { Doughnut } from 'react-chartjs-2';

ChartJS.register(ArcElement,
    Tooltip,
    Legend
);

function App() {
    alert("Hello! I am an alert box!!");

    const data = {
        labels: ['Yes', 'No'],
        datasets: [{
            label: 'Poll',
            data: [50, 50],
            backgroundColor: [
                'red',
                'blue']
        }]
    }

    const options = {
    }
    return (
        <div className="App">
            <h1 style={{ padding: '20px' }}>ChartJS</h1>
            <div>
                <Doughnut
                    data={data}
                    options={options}
                ></Doughnut>
            </div>
        </div>
    );
};

export default App;
