<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#0073C6" points="10,18 0,18 0,20 12,20 12,18 12,6 10,6 "></polygon> <polygon fill="#0073C6" points="0,30 10,30 10,42 12,42 12,30 12,28 0,28 "></polygon> <polygon fill="#0073C6" points="22,18 22,6 20,6 20,18 20,20 48,20 48,18 "></polygon> <polygon fill="#0073C6" points="20,30 20,42 22,42 22,30 48,30 48,28 20,28 "></polygon> <polygon fill="#EF2B2D" points="48,20 20,20 20,6 12,6 12,20 0,20 0,28 12,28 12,42 20,42 20,28 48,28 "></polygon></g></svg></template>

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