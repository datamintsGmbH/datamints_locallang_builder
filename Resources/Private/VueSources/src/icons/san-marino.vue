<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,24H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#0082D0" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V24h48V40z"></path> <path fill="#F5E303" d="M28,20h-2v-2h2v-2h-8v2h2v2h-2c-1.105,0-2,0.896-2,2v6l6,4l6-4v-6C30,20.896,29.105,20,28,20z"></path> <rect x="14" y="20" fill="#006600" width="2" height="8"></rect> <rect x="32" y="20" fill="#006600" width="2" height="8"></rect></g></svg></template>

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