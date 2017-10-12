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
                    type: 'pie',
                    data: {
                        labels: ["Hồng Hà", "Hồng Hà + Cty khác", "Công ty khác"],
                        datasets: [
                            {
                                backgroundColor: ["#FF6384", "#71397C", "#61BA95"],
                                data: this.statistics
                            }

                        ]
                    },
                    options: {
                        responsive: true
                    },
                });
            },
        },
        mounted() {
            this.render();
        },
    };
</script>