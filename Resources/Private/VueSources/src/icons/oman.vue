<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#0F7F12" d="M48,40c0,1.105-0.895,2-2,2H14V30h34V40z"></path> <path fill="#E6E6E6" d="M48,18H14V6h32c1.105,0,2,0.895,2,2V18z"></path> <path fill="#D81B25" d="M14,18V6H2C0.896,6,0,6.895,0,8v32c0,1.105,0.896,2,2,2h12V30h34V18H14z"></path> <polygon fill="#FFFFFF" points="9.857,12.096 8.556,10.578 6.929,11.973 5.302,10.578 4,12.096 5.393,13.289 4,14.482 5.302,16 6.929,14.605 8.556,16 9.857,14.482 8.465,13.289 "></polygon></g></svg></template>

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