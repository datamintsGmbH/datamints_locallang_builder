<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><rect x="16" y="6.5" fill="#E6E6E6" width="16" height="36"></rect> <path fill="#D30F25" d="M48,40.5c0,1.105-0.895,2-2,2H32v-36h14c1.105,0,2,0.895,2,2V40.5z"></path> <path fill="#006847" d="M16,42.5H2c-1.105,0-2-0.895-2-2v-32c0-1.105,0.895-2,2-2h14V42.5z"></path> <path fill="#6B422E" d="M24,18.5c-3.312,0-6,2.688-6,6c0,3.313,2.688,6,6,6c3.313,0,6-2.687,6-6C30,21.188,27.313,18.5,24,18.5z M24,28.5c-2.209,0-4-1.791-4-4s1.791-4,4-4c2.209,0,4,1.791,4,4S26.209,28.5,24,28.5z"></path></g></svg></template>

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