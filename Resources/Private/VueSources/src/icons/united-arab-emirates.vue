<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#169D4D" d="M48,18H16V6h30c1.105,0,2,0.895,2,2V18z"></path> <rect x="16" y="18" fill="#E6E6E6" width="32" height="12"></rect> <path fill="#000105" d="M48,40c0,1.105-0.895,2-2,2H16V30h32V40z"></path> <path fill="#CC162C" d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path></g></svg></template>

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