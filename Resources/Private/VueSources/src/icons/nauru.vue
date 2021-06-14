<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#040385" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V26h48V40z"></path> <rect y="22" fill="#FBFD02" width="48" height="4"></rect> <path fill="#040385" d="M48,22H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V22z"></path> <polygon fill="#FBFD02" points="8,29.057 8.855,31.463 11.162,30.366 10.065,32.673 12.472,33.528 10.065,34.384 11.162,36.69 8.855,35.594 8,38 7.145,35.594 4.838,36.69 5.935,34.384 3.528,33.528 5.935,32.673 4.838,30.366 7.145,31.463 "></polygon></g></svg></template>

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