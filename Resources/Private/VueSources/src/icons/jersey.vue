<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#CE2029" d="M48,8c0-1.104-0.896-2-2-2L24,22L2,6C0.896,6,0,6.896,0,8l22,16L0,40c0,1.104,0.896,2,2,2l22-16l22,16 c1.104,0,2-0.896,2-2L26,24L48,8z"></path> <polygon fill="#E6E6E6" points="0,8 0,40 22,24 "></polygon> <polygon fill="#E6E6E6" points="26,24 48,40 48,8 "></polygon> <polygon fill="#E6E6E6" points="2,42 46,42 24,26 "></polygon> <polygon fill="#E6E6E6" points="46,6 2,6 24,22 "></polygon> <polygon fill="#CE2029" points="28,10 20,10 20,15.332 24,18 28,15.332 "></polygon></g></svg></template>

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