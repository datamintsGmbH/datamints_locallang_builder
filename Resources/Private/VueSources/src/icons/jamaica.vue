<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polyline fill="#161616" points="0,38 0,10 20,24 "></polyline> <polyline fill="#161616" points="48,38 48,10 28,24 "></polyline> <path fill="#F4CE01" d="M48,8c0-1.104-0.895-2-2-2h-2L24,20L4,6H2C0.895,6,0,6.896,0,8v2l20,14L0,38v2c0,1.104,0.895,2,2,2h2l20-14 l20,14h2c1.105,0,2-0.896,2-2v-2L28,24l20-14V8z"></path> <polygon fill="#009D39" points="24,28 24,28 4,42 44,42 "></polygon> <polygon fill="#009D39" points="24,20 24,20 4,6 44,6 "></polygon></g></svg></template>

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