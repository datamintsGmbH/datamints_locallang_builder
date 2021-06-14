<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#DA1A40" d="M12,22h16L8,6H2C0.896,6,0,6.895,0,8v12v20c0,1.105,0.896,2,2,2h28L12,22z"></path> <polygon fill="#FFFFFF" points="12.615,29.994 11.4,32.365 14,32.959 11.543,33.996 13.152,36.119 10.604,35.336 10.47,38 9.024,35.76 7.209,37.713 7.54,35.068 4.895,35.398 6.85,33.584 4.61,32.137 7.272,32.004 6.487,29.455 8.612,31.064 9.649,28.609 10.243,31.207 "></polygon> <circle fill="#FFFFFF" cx="9" cy="15" r="2"></circle> <path fill="#FFFFFF" d="M9,20c-2.757,0-5-2.242-5-5h2c0,1.654,1.346,3,3,3s3-1.346,3-3h2C14,17.758,11.757,20,9,20z"></path></g></svg></template>

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