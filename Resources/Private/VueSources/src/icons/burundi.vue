<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polyline fill="#2CB04D" points="0,38 0,10 20,24 "></polyline> <polyline fill="#2CB04D" points="48,38 48,10 28,24 "></polyline> <path fill="#E6E6E6" d="M48,8c0-1.105-0.895-2-2-2h-2L24,20L4,6H2C0.895,6,0,6.895,0,8v2l20,14L0,38v2c0,1.105,0.895,2,2,2h2l20-14 l20,14h2c1.105,0,2-0.895,2-2v-2L28,24l20-14V8z"></path> <polygon fill="#BD2230" points="24,28 24,28 4,42 44,42 "></polygon> <polygon fill="#BD2230" points="24,20 24,20 4,6 44,6 "></polygon> <circle fill="#E6E6E6" cx="24" cy="24" r="10"></circle> <path fill="#BD2230" d="M26.145,19.299h-1.46l-0.612-1.33l-0.613,1.33H22l1.066,1.1L22.672,22l1.4-0.795l1.4,0.795l-0.394-1.602 L26.145,19.299z"></path> <path fill="#BD2230" d="M22.145,25.33h-1.46L20.072,24l-0.613,1.33H18l1.066,1.1l-0.395,1.602l1.4-0.795l1.4,0.795l-0.394-1.602 L22.145,25.33z"></path> <path fill="#BD2230" d="M30.145,25.33h-1.46L28.072,24l-0.613,1.33H26l1.066,1.1l-0.395,1.602l1.4-0.795l1.4,0.795l-0.394-1.602 L30.145,25.33z"></path></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>