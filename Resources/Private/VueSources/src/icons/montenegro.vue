<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#D5AD3B" d="M46,6H2C0.895,6,0,6.896,0,8v32c0,1.104,0.895,2,2,2h44c1.105,0,2-0.896,2-2V8C48,6.896,47.105,6,46,6z M44,38H4V10h40V38z"></path> <rect x="4" y="10" fill="#C40308" width="40" height="28"></rect> <path fill="#D5AD3B" d="M24,16c0-1.105-0.895-2-2-2h-4c-1.105,0-2,0.895-2,2H24z"></path> <path fill="#D5AD3B" d="M32,20v4h-4v-8h4c0-1.104-0.895-2-2-2h-2h-2c-1.105,0-2,0.896-2,2c0-1.104-0.895-2-2-2h-2v10h-4v-4 c-1.105,0-2,0.896-2,2v4c0,1.104,0.895,2,2,2h4.127l-1.119,4.102l3.461-2.692L24,34l1.531-4.591l3.461,2.692L27.873,28H32 c1.105,0,2-0.896,2-2v-4C34,20.896,33.105,20,32,20z"></path> <line fill="#D5AD3B" x1="24" y1="34" x2="22" y2="28"></line></g></svg></template>

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