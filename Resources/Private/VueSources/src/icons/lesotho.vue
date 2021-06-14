<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#27378F" d="M48,16H0V8c0-1.105,0.895-2,2-2h44c1.105,0,2,0.895,2,2V16z"></path> <rect y="16" fill="#E6E6E6" width="48" height="16"></rect> <path fill="#029544" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2v-8h48V40z"></path> <path fill="#4D4D4D" d="M29.477,29.986l-2.883-4.994C27.447,24.26,28,23.184,28,21.969c0-2.211-1.789-4-4-4c-2.211,0-4,1.789-4,4 c0,1.215,0.553,2.291,1.406,3.023l-2.883,4.994H29.477z"></path></g></svg></template>

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