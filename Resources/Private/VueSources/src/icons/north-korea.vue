<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0B51A0" d="M48,14H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V14z"></path> <path fill="#0B51A0" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-6h48V40z"></path> <rect y="16" fill="#EA2130" width="48" height="16"></rect> <rect y="14" fill="#FFFFFF" width="48" height="2"></rect> <rect y="32" fill="#FFFFFF" width="48" height="2"></rect> <circle fill="#FFFFFF" cx="14" cy="24" r="6"></circle> <path fill="#EA2130" d="M18.185,22.613h-2.948L14,19.93l-1.237,2.684H9.815l2.153,2.227l-0.796,3.231L14,26.465l2.827,1.606 l-0.796-3.231L18.185,22.613z"></path></g></svg></template>

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