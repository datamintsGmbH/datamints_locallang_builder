<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#31AD68" d="M48,40c0,1.105-0.895,2-2,2H18V6h28c1.105,0,2,0.895,2,2V40z"></path> <path fill="#31AD68" d="M18,6H2C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h16V6z"></path> <path fill="#FFFFFF" d="M34,16c0-2.609-1.674-4.807-4-5.633C30.629,10.145,31.295,10,32,10c3.314,0,6,2.686,6,6s-2.686,6-6,6 c-0.705,0-1.371-0.145-2-0.367C32.326,20.807,34,18.609,34,16z"></path> <rect x="24" y="12" fill="#FFFFFF" width="2" height="2"></rect> <rect x="28" y="12" fill="#FFFFFF" width="2" height="2"></rect> <rect x="28" y="16" fill="#FFFFFF" width="2" height="2"></rect> <rect x="24" y="16" fill="#FFFFFF" width="2" height="2"></rect> <rect x="26" y="14" fill="#FFFFFF" width="2" height="2"></rect> <path fill="#A43945" d="M10,6v36h8V6H10z M16,38h-4v-4h4V38z M16,32h-4v-4h4V32z M16,26h-4v-4h4V26z M16,20h-4v-4h4V20z M16,14h-4 v-4h4V14z"></path></g></svg></template>

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