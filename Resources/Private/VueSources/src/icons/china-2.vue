<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D82827" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V40z"></path> <path fill="#FFFD38" d="M15.396,13.299H11.77L10.248,10l-1.523,3.299H5.101l2.648,2.74l-0.978,3.975l3.477-1.976l3.478,1.976 l-0.979-3.975L15.396,13.299z"></path> <circle fill="#FFFD38" cx="17" cy="11" r="1"></circle> <circle fill="#FFFD38" cx="17" cy="19" r="1"></circle> <ellipse fill="#FFFD38" cx="21" cy="13" rx="1" ry="1.001"></ellipse> <ellipse fill="#FFFD38" cx="20.999" cy="17" rx="1.002" ry="1"></ellipse></g></svg></template>

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