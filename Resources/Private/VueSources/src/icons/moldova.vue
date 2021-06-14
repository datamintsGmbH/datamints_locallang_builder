<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="16" y="6" fill="#F5E303" width="16" height="36"></rect> <path fill="#EE1E2E" d="M48,40c0,1.105-0.895,2-2,2H32V6h14c1.105,0,2,0.895,2,2V40z"></path> <path fill="#2B3384" d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path> <path fill="#685A11" d="M30,20h-4v-2c0-1.104-0.895-2-2-2h-2c-1.105,0-2,0.896-2,2h2v2h-4v6.93c0,0.669,0.334,1.293,0.891,1.664 L24,32l5.109-3.406C29.666,28.223,30,27.599,30,26.93V20z"></path></g></svg></template>

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