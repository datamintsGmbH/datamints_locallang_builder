<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#AF2839" d="M48,8c0-1.105-0.896-2-2-2H20v20H0v14c0,1.105,0.896,2,2,2h44c1.104,0,2-0.895,2-2V8z"></path> <rect x="20" y="10" fill="#E6E6E6" width="28" height="4"></rect> <rect x="20" y="18" fill="#E6E6E6" width="28" height="4"></rect> <polygon fill="#E6E6E6" points="0,26 0,30 48,30 48,26 20,26 "></polygon> <rect y="34" fill="#E6E6E6" width="48" height="4"></rect> <path fill="#202D61" d="M20,26H0V8c0-1.105,0.895-2,2-2h18V26z"></path> <path fill="#FFFFFF" d="M14.185,14.613h-2.948L10,11.93l-1.237,2.684H5.815l2.153,2.227L7.173,20.07L10,18.465l2.827,1.606 l-0.796-3.231L14.185,14.613z"></path></g></svg></template>

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