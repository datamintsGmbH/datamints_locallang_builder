<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D01E2A" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <path fill="#3D7838" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V28h48V40z"></path> <rect y="18" fill="#1D266B" width="48" height="12"></rect> <rect y="18" fill="#FFFFFF" width="48" height="2"></rect> <rect y="28" fill="#FFFFFF" width="48" height="2"></rect></g></svg></template>

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