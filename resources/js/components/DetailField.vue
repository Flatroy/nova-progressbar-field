<template>
    <div
        class="-mx-6 flex flex-col space-y-2 px-6 py-2 md:flex-row md:space-y-0 md:py-0"
        :class="{ 'border-t border-gray-100 dark:border-gray-700': index !== 0 }"
    >
        <div class="md:w-1/4 md:py-3" v-if="!hideLabel">
            <slot>
                <h4 class="font-bold md:font-normal">
                    <span>{{ label }}</span>
                </h4>
            </slot>
        </div>

        <div class="break-words md:w-3/4 md:py-3">
            <slot name="value">
                <p v-if="fieldValue && !shouldDisplayAsHtml" class="text-90 pg-bar">
                    <span class="pg-bar" ref="chartContainer"></span>
                </p>
                <div v-else-if="fieldValue && shouldDisplayAsHtml" v-html="field.value"></div>
                <p v-else>&mdash;</p>
            </slot>
        </div>
    </div>
</template>

<script>
    const ProgressBar = require('progressbar.js');

    export default {
        props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
        data() {
            return {
                options: {
                    strokeWidth: 4,
                    color: '#FFEA82',
                    percentage: 1.0,
                    type: 'line',
                    sub: null,
                    fromColor: '#FFEA82',
                    toColor: '#FFEA82',
                    animateColor: false,
                },
                subtitle: '',
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
        },
        computed: {
            label() {
                return this.fieldName || this.field.name;
            },

            fieldValue() {
                if (this.field.value === '' || this.field.value === null || this.field.value === undefined) {
                    return false;
                }

                return String(this.field.value);
            },

            shouldDisplayAsHtml() {
                return this.field.asHtml;
            },

            hideLabel() {
                return this.field.hideLabel;
            },
        },
        methods: {
            drawLine() {
                let bar = new ProgressBar.Line(this.$refs.chartContainer, {
                    strokeWidth: this.options.strokeWidth,
                    easing: 'easeInOut',
                    duration: 1400,
                    color: this.options.color,
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: null,
                    text: {
                        style: {
                            color: '#999',
                            textAlign: 'center',
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
                        let labelProgress = Math.round(bar.value() * 100) + ' % ';

                        if (this.field.subtitle) {
                            labelProgress += this.field.subtitle;
                        }

                        bar.setText(labelProgress);
                        if (this.options.animateColor) {
                            bar.path.setAttribute('stroke', state.color);
                        }
                    },
                });
                if (this.field.value) {
                    bar.animate(this.field.value);
                }
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
