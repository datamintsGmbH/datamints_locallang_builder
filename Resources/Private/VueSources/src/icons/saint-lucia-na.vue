<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M48,40a2,2,0,0,1-2,2H2a2,2,0,0,1-2-2V8A2,2,0,0,1,2,6H46a2,2,0,0,1,2,2Z" fill="#67cbfd"></path> <polygon points="36 38 24 10 12 38 36 38" fill="#fff"></polygon> <polygon points="15.033 36 24 15.077 32.967 36 15.033 36"></polygon> <polygon points="24 25 12 38 36 38 24 25" fill="#eac52a"></polygon></g></svg></template>

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