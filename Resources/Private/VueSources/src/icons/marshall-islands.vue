<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#013893" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2l48-10V40z"></path> <polygon fill="#E6E6E6" points="0,40 48,30 48,18 "></polygon> <path fill="#013893" d="M0,40L42,6H2C0.895,6,0,6.895,0,8V40z"></path> <path fill="#DD7506" d="M48,8c0-1.105-0.895-2-2-2h-4L0,40l48-22V8z"></path> <polygon fill="#FFFFFF" points="13.239,13.301 12.199,15.49 15.982,16.301 12.199,17.113 13.239,19.301 11.051,18.262 10.239,22.043 9.428,18.262 7.239,19.301 8.279,17.113 3.982,16.301 8.279,15.49 7.239,13.301 9.428,14.342 10.239,10.043 11.051,14.342 "></polygon></g></svg></template>

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