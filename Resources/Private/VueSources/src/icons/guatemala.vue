<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="16" y="6" fill="#E6E6E6" width="16" height="36"></rect> <path fill="#4897D0" d="M48,40c0,1.105-0.895,2-2,2H32V6h14c1.105,0,2,0.895,2,2V40z"></path> <path fill="#4897D0" d="M16,42H2c-1.105,0-2-0.895-2-2V8c0-1.105,0.895-2,2-2h14V42z"></path> <path fill="#738356" d="M24,18c-3.312,0-6,2.688-6,6c0,3.313,2.688,6,6,6c3.313,0,6-2.687,6-6C30,20.688,27.313,18,24,18z M24,28 c-2.209,0-4-1.791-4-4s1.791-4,4-4c2.209,0,4,1.791,4,4S26.209,28,24,28z"></path></g></svg></template>

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