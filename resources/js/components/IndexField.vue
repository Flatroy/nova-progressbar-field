<template>
  <div class="w-full" :class="padding">
    <span class="pg-bar" ref="chartContainer"></span>
  </div>
</template>

<script>
    const ProgressBar = require('progressbar.js');
    const widthSizes = {
      large: '',
      medium: 'px-6',
      small: 'px-10'
    }

    export default {
        props: ['resourceName', 'field'],
        data() {
            return {
                options: {
                    strokeWidth: 4,
                    color: '#FFEA82',
                    fromColor: '#FFEA82',
                    toColor: '#FFEA82',
                    percentage: 1.0,
                    type: 'line',
                    sub: null,
                    animateColor: false,
                },
                padding: ''
            };
        },
        mounted: function () {
            for (const key in this.field.options) {
                if (this.field.options.hasOwnProperty(key)) {
                    this.options[key] = this.field.options[key];
                }
            }
            switch (this.options.type) {
                case 'semi-circle':
                    this.drawSemiCircle();
                    break;

                default:
                    this.drawLine();
                    break;
            }
            this.padding = widthSizes[this.options.width] ?? widthSizes.full;
        },
        methods: {
            drawLine() {
                let bar = new ProgressBar.Line(this.$refs.chartContainer, {
                    strokeWidth: this.options.strokeWidth,
                    easing: 'easeInOut',
                    duration: 1000,
                    color: this.options.color,
                    trailColor: '#E5E4F0',
                    trailWidth: 4,

                    svgStyle: null,
                    text: {
                        style: {
                            color: '#999',
                            textAlign: 'right',
                            position: 'relative',
                            padding: 0,
                            margin: 0,
                            transform: null,
                        },
                        autoStyleContainer: false,
                    },
                    from: { color: this.options.fromColor },
                    to: { color: this.options.toColor },
                    step: (state, bar) => {
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                        if (this.options.animateColor) {
                            bar.path.setAttribute('stroke', state.color);
                        }
                    },
                });

                this.$nextTick(() => {
                    if (this.field.value) {
                        bar.animate(this.field.value);
                    }
                });
            },
        },
    };
</script>

<style scoped>
    .pg-bar {
        max-width: 400px;
        width: 100%;
    }
</style>
