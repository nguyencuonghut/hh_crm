<template>
    <canvas width="750" height="400" ref="canvaschart"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: ['statistics'],
        methods: {
            render(data)
            {
                this.Chart = new Chart(this.$refs.canvaschart.getContext('2d'), {
                    type: 'horizontalBar',
                    data: {
                        labels: ["Lợn", "Gà thịt", "Vịt thịt", "Cút", "Thủy sản", "Gà đẻ", "Vịt đẻ", "Bò"],
                        datasets: [
                            {
                                backgroundColor: ["#FF6384", "#FF6384", "#FF6384", "#FF6384", "#FF6384", "#FF6384", "#FF6384", "#FF6384"],
                                data: this.statistics,
                                label: 'Số lượng'
                            }

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
                                    ctx.textAlign = 'top';
                                    ctx.textBaseline = 'bottom';
                                    ctx.fillStyle = 'black';

                                    this.data.datasets.forEach(function (dataset, i) {
                                        var meta = chartInstance.controller.getDatasetMeta(i);
                                        meta.data.forEach(function (bar, index) {
                                            var data = dataset.data[index];
                                            ctx.fillText(data, bar._model.x, bar._model.y + 7);
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