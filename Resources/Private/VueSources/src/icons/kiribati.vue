<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#040385" d="M48,40c0,1.105-0.895,2-2,2H2c-1.105,0-2-0.895-2-2H48z"></path> <rect y="38" fill="#E6E6E6" width="48" height="2"></rect> <rect y="36" fill="#040385" width="48" height="2"></rect> <rect y="34" fill="#E6E6E6" width="48" height="2"></rect> <rect y="30" fill="#E6E6E6" width="48" height="2"></rect> <rect y="32" fill="#040385" width="48" height="2"></rect> <path fill="#FC0204" d="M0,30h48V8c0-1.105-0.895-2-2-2H2C0.895,6,0,6.895,0,8V30z"></path> <path fill="#FFD416" d="M34,30c0-5.522-4.478-10-10-10c-5.522,0-10,4.478-10,10H34z"></path> <path fill="#FFD416" d="M18,16c-1.104,0-2,0.896-2,2h14c0-1.104-0.896-2-2-2h-4v-4h2c1.104,0,2-0.896,2-2h-6v2h-6 c0,1.104,0.896,2,2,2h2v2H18z"></path></g></svg></template>

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