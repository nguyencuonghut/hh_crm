<template>
    <canvas width="730" height="240" ref="canvasline"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['candidate_farms', 'opened_farms', 'candidate_agents', 'opened_agents'],
        methods: {
            render(data)
            {
                this.Chart = new Chart(this.$refs.canvasline.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                        datasets: [
                            {
                                label: 'Trại tiềm năng',
                                borderColor: "red",
                                data: this.candidate_farms
                                //data: [40, 39, 10, 40, 39, 20, 40, 30, 10, 20, 50, 90]
                            },
                            {
                                label: 'Trại mới mở',
                                borderColor: "green",
                                data: this.opened_farms
                                //data: [30, 45, 22, 5, 12, 22, 43, 20, 5, 10, 25, 45]
                            },
                            {
                                label: 'Đại lý tiềm năng',
                                borderColor: "blue",
                                data: this.candidate_agents
                                //data: [30, 29, 5, 20, 19, 30, 30, 40, 20, 4, 30, 60]
                            },
                            {
                                label: 'Đại lý mới mở',
                                borderColor: "purple",
                                data: this.opened_agents
                                //data: [60, 55, 32, 10, 2, 12, 53, 44, 60, 70, 77, 50]
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        events: false,
                        tooltips: {
                            enabled: false
                        },
                        hover: {
                            animationDuration: 0
                        },
                        animation:
                        {
                            duration: 1,
                            onComplete: function ()
                            {
                                var chartInstance = this.chart,
                                    ctx = chartInstance.ctx;
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';
                                ctx.fillStyle = 'black';

                                this.data.datasets.forEach(function (dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function (bar, index) {
                                        var data = dataset.data[index];
                                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                    });
                                });
                            }
                        }
                    },
                });
            },
        },
        mounted() {
            this.render();
        },
    };
</script>