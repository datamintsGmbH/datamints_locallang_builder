<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="16" y="6" fill="#BD0712" width="16" height="36"></rect> <path fill="#149717" d="M48,40c0,1.105-0.895,2-2,2H32V6h14c1.105,0,2,0.895,2,2V40z"></path> <path d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path> <path fill="#FFFFFF" d="M18,24c0,3.314,2.686,6,6,6c3.314,0,6-2.686,6-6 M24,28c-2.209,0-4-1.791-4-4s4-6,4-6s4,3.791,4,6 S26.209,28,24,28z"></path></g></svg></template>

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