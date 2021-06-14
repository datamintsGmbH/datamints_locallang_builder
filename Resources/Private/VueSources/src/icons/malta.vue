<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D90E2B" d="M48,40c0,1.105-0.895,2-2,2H24V6h22c1.105,0,2,0.895,2,2V40z"></path> <path fill="#E6E6E6" d="M24,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h22V42z"></path> <rect x="6" y="10" fill="#B3B3B3" width="4" height="8"></rect> <rect x="4" y="12" fill="#B3B3B3" width="8" height="4"></rect></g></svg></template>

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