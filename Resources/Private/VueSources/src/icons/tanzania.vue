<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon fill="#FADC30" points="48,18 12,42 4.789,42 48,13.193 "></polygon> <polygon fill="#FADC30" points="36,6 43.211,6 0,34.807 0,30 "></polygon> <path fill="#26B34A" d="M2,6h34L0,30V8C0,6.895,0.895,6,2,6z"></path> <path fill="#179FDB" d="M46,42H12l36-24v22C48,41.105,47.105,42,46,42z"></path> <path fill="#44443C" d="M4.789,42H2c-1.105,0-2-0.895-2-2v-5.193L43.211,6H46c1.105,0,2,0.895,2,2v5.193L4.789,42z"></path></g></svg></template>

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