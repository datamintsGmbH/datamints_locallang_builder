<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V24h48V40z"></path> <path fill="#EA2C3F" d="M48,24H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V24z"></path> <path fill="#FFFFFF" d="M8,16c0-2.607,1.675-4.805,4-5.633C11.371,10.145,10.705,10,10,10c-3.313,0-6,2.688-6,6c0,3.313,2.687,6,6,6 c0.705,0,1.371-0.145,2-0.367C9.675,20.805,8,18.607,8,16z"></path> <circle fill="#FFFFFF" cx="19" cy="11" r="1"></circle> <circle fill="#FFFFFF" cx="19" cy="19" r="1"></circle> <ellipse fill="#FFFFFF" cx="15" cy="17.001" rx="1" ry="1.001"></ellipse> <ellipse fill="#FFFFFF" cx="23" cy="13" rx="1" ry="1.001"></ellipse> <ellipse fill="#FFFFFF" cx="22.999" cy="17" rx="1.002" ry="1"></ellipse> <ellipse fill="#FFFFFF" cx="15" cy="13.002" rx="1.001" ry="1"></ellipse></g></svg></template>

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