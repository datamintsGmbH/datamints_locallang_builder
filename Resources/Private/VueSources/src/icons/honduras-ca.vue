<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0C72C4" d="M48,18H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V18z"></path> <rect y="18" fill="#E6E6E6" width="48" height="12"></rect> <path fill="#0C72C4" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V30h48V40z"></path> <path fill="#0067C6" d="M18.273,19.368h-1.506L16.137,18l-0.633,1.368H14l1.1,1.14l-0.406,1.648l1.443-0.818l1.443,0.818 l-0.406-1.648L18.273,19.368z"></path> <path fill="#0067C6" d="M18.273,27.212h-1.506l-0.631-1.368l-0.633,1.368H14l1.1,1.14L14.693,30l1.443-0.818L17.58,30l-0.406-1.648 L18.273,27.212z"></path> <path fill="#0067C6" d="M34,19.368h-1.506L31.863,18l-0.633,1.368h-1.504l1.1,1.14l-0.406,1.648l1.443-0.818l1.443,0.818 L32.9,20.508L34,19.368z"></path> <path fill="#0067C6" d="M34,27.212h-1.506l-0.631-1.368l-0.633,1.368h-1.504l1.1,1.14L30.42,30l1.443-0.818L33.307,30L32.9,28.351 L34,27.212z"></path> <path fill="#0067C6" d="M26.137,23.29h-1.506L24,21.922l-0.633,1.368h-1.504l1.1,1.14l-0.406,1.648L24,25.26l1.443,0.818 l-0.406-1.648L26.137,23.29z"></path></g></svg></template>

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