<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FFDD00" d="M48,22H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V22z"></path> <rect y="22" fill="#024FA7" width="48" height="10"></rect> <path fill="#F01A22" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-8h48V40z"></path> <polygon fill="#A67C52" points="30,18 18,18 18,26 24,30 30,26 "></polygon></g></svg></template>

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