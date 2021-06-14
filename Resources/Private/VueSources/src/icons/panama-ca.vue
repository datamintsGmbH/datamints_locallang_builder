<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#E6E6E6" d="M24,24H0V8c0-1.105,0.895-2,2-2h22V24z"></path> <path fill="#025193" d="M16.184,13.613h-2.947L12,10.93l-1.238,2.684H7.816l2.152,2.227l-0.797,3.23L12,17.465l2.828,1.605 l-0.797-3.23L16.184,13.613z"></path> <path fill="#E6E6E6" d="M48,40c0,1.105-0.895,2-2,2H24V24h24V40z"></path> <path fill="#025193" d="M0,40c0,1.105,0.895,2,2,2h22V24H0V40z"></path> <path fill="#D21033" d="M40.184,31.613h-2.947L36,28.93l-1.238,2.684h-2.945l2.152,2.227l-0.797,3.231L36,35.465l2.828,1.606 l-0.797-3.231L40.184,31.613z"></path> <path fill="#D21033" d="M24,24h24V8c0-1.105-0.895-2-2-2H24V24z"></path></g></svg></template>

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