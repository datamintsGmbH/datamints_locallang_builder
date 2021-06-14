<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#424041" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#E52635" width="48" height="12"></rect> <path fill="#0EA651" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <rect y="18" fill="#FFFFFF" width="48" height="2"></rect> <rect y="28" fill="#FFFFFF" width="48" height="2"></rect> <path fill="#244A93" d="M2,6C0.896,6,0,6.895,0,8v16v16c0,1.105,0.896,2,2,2l20-18L2,6z"></path> <path fill="#FFCE19" d="M14.369,22.543h-2.948l-1.236-2.684l-1.237,2.684H6l2.153,2.227L7.357,28l2.827-1.605L13.012,28l-0.796-3.23 L14.369,22.543z"></path></g></svg></template>

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