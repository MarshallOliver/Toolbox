export default {
	methods: {

		debugLevel: function (value, level = 2) {
			const values = [];

			Array.isArray(value) ? value.forEach(element => values.push(element)) : values[0] = value;

			switch (level) {
			
				case 1:
					
					if (process.env.NODE_ENV == 'test' || process.env.NODE_ENV == 'development') {
						values.forEach(element => console.log(element));
					}

					break;
				case 2:

					if (process.env.NODE_ENV == 'development') {
						values.forEach(element => console.log(element));
					}

					break;
				default:

					values.forEach(element => console.log(element));

					break;
			
			}

		},

	}
}