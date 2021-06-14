<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon fill="#FFFFFF" points="2,6 38,24 2,42 46,24 "></polygon> <polygon fill="#F3CF0B" points="2,6 24,24 2,42 38,24 "></polygon> <polygon points="24,24 2,6 20,24 2,42 "></polygon> <path fill="#D00E30" d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l18-18L2,6z"></path> <path fill="#009E49" d="M46,6H2l44,18L2,42h44c1.104,0,2-0.896,2-2V24V8C48,6.896,47.104,6,46,6z"></path></g></svg></template>

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