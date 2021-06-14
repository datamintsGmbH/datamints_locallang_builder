<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FCCE07" d="M20,42H2c-1.105,0-2-0.895-2-2v-6h20V42z"></path> <rect y="24" fill="#289941" width="20" height="10"></rect> <rect y="14" fill="#E6E6E6" width="20" height="10"></rect> <path fill="#283B7F" d="M20,14H0V8c0-1.105,0.895-2,2-2h18V14z"></path> <path fill="#FCCE07" d="M28,42h18c1.105,0,2-0.895,2-2v-6H28V42z"></path> <rect x="28" y="24" fill="#289941" width="20" height="10"></rect> <rect x="28" y="14" fill="#E6E6E6" width="20" height="10"></rect> <path fill="#283B7F" d="M28,14h20V8c0-1.105-0.895-2-2-2H28V14z"></path> <rect x="20" y="6" fill="#D51F36" width="8" height="36"></rect> <path fill="#F6D031" d="M8,9.33H6.54L5.928,8L5.314,9.33H3.855l1.066,1.1l-0.394,1.602l1.4-0.795l1.4,0.795L6.934,10.43L8,9.33z"></path></g></svg></template>

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