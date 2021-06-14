<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FB0D1B" d="M48,8c0-1.105-0.895-2-2-2H20v16H0v18c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2V8z"></path> <path fill="#031092" d="M20,22H0V8c0-1.105,0.895-2,2-2h18V22z"></path> <circle fill="#FFFFFF" cx="10" cy="14" r="4"></circle></g></svg></template>

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