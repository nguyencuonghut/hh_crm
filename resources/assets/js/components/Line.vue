<template>
    <canvas width="730" height="240" ref="canvasline"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        methods: {
            render(data)
            {
                this.Chart = new Chart(this.$refs.canvasline.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets: [
                            {
                                label: 'Trại tiềm năng',
                                borderColor: "red",
                                data: [40, 39, 10, 40, 39, 20, 40, 30, 10, 20, 50, 90]
                            },
                            {
                                label: 'Trại mới mở',
                                borderColor: "lime",
                                data: [30, 45, 22, 5, 12, 22, 43, 20, 5, 10, 25, 45]
                            },
                            {
                                label: 'Đại lý tiềm năng',
                                borderColor: "blue",
                                data: [30, 29, 5, 20, 19, 30, 30, 40, 20, 4, 30, 60]
                            },
                            {
                                label: 'Đại lý mới mở',
                                borderColor: "purple",
                                data: [60, 55, 32, 10, 2, 12, 53, 44, 60, 70, 77, 50]
                            },
                        ]
                    },
                    options: {
                        responsive: true,

                    },
                });
            },
        },
        mounted() {
            this.render();
        },
    };
</script>