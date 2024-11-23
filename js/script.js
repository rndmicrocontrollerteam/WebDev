const sidebar = document.getElementById("sidebar");
const toggleButton = document.getElementById("toggleSidebar");
const sidebarTextElements = document.querySelectorAll(".sidebar-text");
const shadowClass = document.querySelectorAll(".shadow-xl");

toggleButton.addEventListener("click", () => {
    sidebar.classList.toggle("w-16");
    sidebar.classList.toggle("w-64");
    sidebarTextElements.forEach(el => {
        el.classList.toggle("hidden");
    });
});

// // Dark mode toggle functionality
// const darkButton = document.getElementById("toggleTheme");
// const themeIcon = document.getElementById("themeIcon");
// const body = document.querySelector("body");

// darkButton.addEventListener("click", () => {
//     body.classList.toggle("bg-slate-800");
//     body.classList.toggle("text-white");

//     if (body.classList.contains("bg-slate-800")) {
//         themeIcon.innerHTML = "brightness_7";
//     } else {
//         themeIcon.innerHTML = "brightness_4";
//     }
// });

// Canvas setup
const canvas = document.querySelector('#scene');
const ctx = canvas.getContext('2d');

function setCanvasSize() {
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;

    if (window.devicePixelRatio > 1) {
        canvas.width = canvas.clientWidth * 2;
        canvas.height = canvas.clientHeight * 2;
        ctx.scale(2, 2);
    }
}

setCanvasSize();

// Variables and constants
let width = canvas.clientWidth;
let height = canvas.clientHeight;
let rotation = 0;
let dots = [];
const DOTS_AMOUNT = 1000;
const DOT_RADIUS = 4;
let GLOBE_RADIUS = width * 0.7;
let GLOBE_CENTER_Z = -GLOBE_RADIUS;
let PROJECTION_CENTER_X = width / 2;
let PROJECTION_CENTER_Y = height / 2;
let FIELD_OF_VIEW = width * 0.8;

// Dot class for 3D projection
class Dot {
    constructor(x, y, z) {
        this.x = x;
        this.y = y;
        this.z = z;
        this.xProject = 0;
        this.yProject = 0;
        this.sizeProjection = 0;
    }

    project(sin, cos) {
        const rotX = cos * this.x + sin * (this.z - GLOBE_CENTER_Z);
        const rotZ = -sin * this.x + cos * (this.z - GLOBE_CENTER_Z) + GLOBE_CENTER_Z;
        this.sizeProjection = FIELD_OF_VIEW / (FIELD_OF_VIEW - rotZ);
        this.xProject = (rotX * this.sizeProjection) + PROJECTION_CENTER_X;
        this.yProject = (this.y * this.sizeProjection) + PROJECTION_CENTER_Y;
    }

    draw(sin, cos) {
        this.project(sin, cos);
        ctx.beginPath();
        ctx.arc(this.xProject, this.yProject, DOT_RADIUS * this.sizeProjection, 0, Math.PI * 2);
        ctx.closePath();
        ctx.fillStyle = "#3B82F6"; // Tailwind's blue-500 color hex
        ctx.fill();
    }
}

function createDots() {
    dots = [];
    for (let i = 0; i < DOTS_AMOUNT; i++) {
        const theta = Math.random() * 2 * Math.PI;
        const phi = Math.acos((Math.random() * 2) - 1);

        const x = GLOBE_RADIUS * Math.sin(phi) * Math.cos(theta);
        const y = GLOBE_RADIUS * Math.sin(phi) * Math.sin(theta);
        const z = (GLOBE_RADIUS * Math.cos(phi)) + GLOBE_CENTER_Z;

        dots.push(new Dot(x, y, z));
    }
}

// Render function for the globe
function render(a) {
    ctx.clearRect(0, 0, width, height);

    rotation = a * 0.0004;
    const sineRotation = Math.sin(rotation);
    const cosineRotation = Math.cos(rotation);

    dots.forEach(dot => dot.draw(sineRotation, cosineRotation));
    window.requestAnimationFrame(render);
}

function afterResize() {
    width = canvas.offsetWidth;
    height = canvas.offsetHeight;
    setCanvasSize();
    GLOBE_RADIUS = width * 0.9;
    GLOBE_CENTER_Z = -GLOBE_RADIUS;
    PROJECTION_CENTER_X = width / 2;
    PROJECTION_CENTER_Y = height / 2;
    FIELD_OF_VIEW = width * 0.8;
    createDots();
}

let resizeTimeout;
function onResize() {
    resizeTimeout = window.clearTimeout(resizeTimeout);
    resizeTimeout = window.setTimeout(afterResize, 500);
}
window.addEventListener('resize', onResize);

createDots();
window.requestAnimationFrame(render);

// Fetch chart data
async function fetchChartData() {
    try {
        const response = await fetch('./data.php');
        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
        return await response.json();
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}

const ctxData = document.getElementById('realtimeChart').getContext('2d');
const ctxCurrent = document.getElementById('currentChart').getContext('2d');

const realtimeChart = new Chart(ctxData, {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Voltage 1',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            },
            {
                label: 'Voltage 2',
                data: [],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            },
            {
                label: 'Voltage 3',
                data: [],
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    font: {
                        family: 'Inter, sans-serif',
                        size: 14,
                    },
                },
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: 'rgba(255, 255, 255, 0.1)',
                borderWidth: 1,
                padding: 10,
                mode: 'index',
                intersect: false,
            },
        },
        scales: {
            x: {
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    color: 'rgba(255, 255, 255, 0.1)',
                    drawBorder: false,
                    drawOnChart: false,
                    drawTicks: false,
                },
            },
            y: {
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    color: 'rgba(255, 255, 255, 0.1)',
                    drawBorder: false,
                    drawOnChart: false,
                    drawTicks: false,
                },
                beginAtZero: false,
            },
        },
        elements: {
            line: {
                tension: 0.4,
            },
            point: {
                radius: 5,
                hitRadius: 10,
                hoverRadius: 7,
                backgroundColor: 'rgba(75, 192, 192, 1)',
            },
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20,
            },
        },
        animation: {
            duration: 800,
            easing: 'easeOutQuart',
        },
    },
});

const currentChart = new Chart(ctxCurrent, {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Current 1',
                data: [],
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(255, 206, 86, 1)',
            },
            {
                label: 'Current 2',
                data: [],
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(153, 102, 255, 1)',
            },
            {
                label: 'Current 3',
                data: [],
                borderColor: 'rgba(255, 159, 64, 1)',
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 2,
                pointBackgroundColor: 'rgba(255, 159, 64, 1)',
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    font: {
                        family: 'Inter, sans-serif',
                        size: 14,
                    },
                },
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: 'rgba(255, 255, 255, 0.1)',
                borderWidth: 1,
                padding: 10,
                mode: 'index',
                intersect: false,
            },
        },
        scales: {
            x: {
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    color: 'rgba(255, 255, 255, 0.1)',
                    drawBorder: false,
                    drawOnChart: false,
                    drawTicks: false,
                },
            },
            y: {
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    color: 'rgba(255, 255, 255, 0.1)',
                    drawBorder: false,
                    drawOnChart: false,
                    drawTicks: false,
                },
                beginAtZero: false,
            },
        },
        elements: {
            line: {
                tension: 0.4,
            },
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20,
            },
        },
        animation: {
            duration: 800,
            easing: 'easeOutQuart',
        },
    },
});

// Update charts
async function updateChart() {
    const data = await fetchChartData();
    if (!data) return;

    const now = new Date().toLocaleTimeString();

    realtimeChart.data.labels.push(now);
    realtimeChart.data.datasets[0].data.push(parseFloat(data.volt1));
    realtimeChart.data.datasets[1].data.push(parseFloat(data.volt2));
    realtimeChart.data.datasets[2].data.push(parseFloat(data.volt3));

    currentChart.data.labels.push(now);
    currentChart.data.datasets[0].data.push(parseFloat(data.arus1));
    currentChart.data.datasets[1].data.push(parseFloat(data.arus2));
    currentChart.data.datasets[2].data.push(parseFloat(data.arus3));

    if (realtimeChart.data.labels.length > 50) {
        realtimeChart.data.labels.shift();
        realtimeChart.data.datasets.forEach(dataset => dataset.data.shift());
    }

    if (currentChart.data.labels.length > 50) {
        currentChart.data.labels.shift();
        currentChart.data.datasets.forEach(dataset => dataset.data.shift());
    }

    realtimeChart.update();
    currentChart.update();
}

setInterval(updateChart, 10000);

