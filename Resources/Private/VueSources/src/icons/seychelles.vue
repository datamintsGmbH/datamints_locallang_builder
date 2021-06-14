<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#3C9038" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2l48-10V40z"></path> <polygon fill="#E6E6E6" points="0,40 48,30 48,20 "></polygon> <polygon fill="#F8D406" points="0,40 42,6 22,6 "></polygon> <path fill="#1C437A" d="M0,40L22,6H2C0.895,6,0,6.895,0,8V40z"></path> <line fill="#F7931E" x1="0" y1="40" x2="48" y2="20"></line> <path fill="#D12325" d="M48,8c0-1.105-0.895-2-2-2h-4L0,40l48-20V8z"></path></g></svg></template>

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