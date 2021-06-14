<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D1142A" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-2h48V40z"></path> <rect y="10" fill="#033E8A" width="48" height="28"></rect> <path fill="#D1142A" d="M48,10H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V10z"></path> <circle fill="#FFFFFF" cx="24" cy="24" r="8"></circle> <circle fill="#7AC943" cx="24" cy="19" r="1"></circle> <circle fill="#7AC943" cx="24" cy="29" r="1"></circle> <ellipse transform="matrix(0.6943 -0.7197 0.7197 0.6943 -6.2854 26.0095)" fill="#7AC943" cx="27.473" cy="20.403" rx="1.001" ry="1"></ellipse> <ellipse transform="matrix(0.6953 -0.7187 0.7187 0.6953 -13.5803 23.1621)" fill="#7AC943" cx="20.527" cy="27.598" rx="1" ry="1"></ellipse> <ellipse transform="matrix(0.9993 -0.0361 0.0361 0.9993 -0.8415 1.0627)" fill="#7AC943" cx="28.997" cy="23.826" rx="1.001" ry="1"></ellipse> <ellipse transform="matrix(0.9994 -0.0342 0.0342 0.9994 -0.816 0.6643)" fill="#7AC943" cx="19.003" cy="24.176" rx="1" ry="1.001"></ellipse> <ellipse transform="matrix(0.6695 -0.7428 0.7428 0.6695 -11.1536 29.6239)" fill="#7AC943" cx="27.715" cy="27.347" rx="1" ry="1.001"></ellipse> <ellipse transform="matrix(0.6695 -0.7428 0.7428 0.6695 -8.6402 21.8924)" fill="#7AC943" cx="20.283" cy="20.656" rx="1.001" ry="0.999"></ellipse> <rect x="22" y="22" fill="#B5B994" width="4" height="4"></rect></g></svg></template>

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