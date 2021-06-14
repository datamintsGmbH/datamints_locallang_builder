<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D01738" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <rect x="8" y="14" fill="#0F7D3D" width="32" height="20"></rect> <path fill="#FFFFFF" d="M22,24c0-3.723,2.557-6.824,6-7.717C27.357,16.117,26.695,16,26,16c-4.418,0-8,3.582-8,8s3.582,8,8,8 c0.695,0,1.357-0.117,2-0.283C24.557,30.824,22,27.723,22,24z"></path></g></svg></template>

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