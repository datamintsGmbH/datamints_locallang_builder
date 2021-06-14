<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path d="M48,40a2,2,0,0,1-2,2H2a2,2,0,0,1-2-2V30H48Z" fill="#e6e6e6"></path><rect y="18" width="48" height="12" fill="#cb2010"></rect><path d="M48,18H0V8A2,2,0,0,1,2,6H46a2,2,0,0,1,2,2Z" fill="#e6e6e6"></path></g></svg></template>

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