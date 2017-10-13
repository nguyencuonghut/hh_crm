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