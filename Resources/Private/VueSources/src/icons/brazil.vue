<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#009C3B" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <polygon fill="#FFFF00" points="23.969,12.031 5.969,24 23.969,36.031 42.031,24 "></polygon> <circle fill="#052379" cx="24" cy="24" r="8"></circle> <path fill="#FFFFFF" d="M26.023,21.952c-1.264-0.632-2.615-0.951-4.019-0.951c-2.237,0-4.318,0.82-5.928,2.232 C16.052,23.49,16,23.737,16,24c0,0.686,0.113,1.34,0.275,1.975c1.298-1.855,3.41-2.974,5.73-2.974c1.09,0,2.141,0.249,3.124,0.74 c2.515,1.257,3.924,3.836,3.846,6.478c0.707-0.566,1.319-1.235,1.8-2.007C30.239,25.597,28.59,23.235,26.023,21.952z"></path></g></svg></template>

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