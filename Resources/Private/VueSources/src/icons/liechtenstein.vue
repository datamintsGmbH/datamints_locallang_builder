<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#1147A7" d="M48,24H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#CE1127" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V24h48V40z"></path> <polygon fill="#F6D031" points="14,12 6,12 6,17.332 10,20 14,17.332 "></polygon></g></svg></template>

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