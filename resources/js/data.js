let programs = [
    {
        id:0,
        data:[
            {
                id: 0,
                imageUrl: '/img/programs/xs.png',
                title: 'XS',
                kcal: '850',
                price: 8000,
                iPrice: 9500,
                shortDescription: 'Интенсивное снижение веса',
                isPopular: false,
                instagramLink: 'https://instagram.com/anarochka_juju/',
                bio: 'Анара - мама троих детей, предприниматель',
                instagram: '@anarochka_juju',
                aims: [
                    {
                        id: 0,
                        description: 'Интенсивного снижения веса (7-14 дней), например, при подготовке к мероприятиям'
                    }
                ],
                extra: 'Настоятельно рекомендуем проконсультироваться с нашим специалистом перед заказом!',
                protein: {
                    weight: '50-60',
                    percentage: 33
                },
                fat: {
                    weight: '35-45',
                    percentage: 43
                },
                carbohydrate: {
                    weight: '80-90',
                    percentage: 24
                }
            },
            {
                id: 1,
                imageUrl: '/img/programs/s.png',
                title: 'S',
                kcal: '1100',
                price: 8500,
                iPrice: 10000,
                shortDescription: 'Комфортное снижение веса',
                isPopular: true,
                instagramLink: 'https://www.instagram.com/amina_khakim/',
                bio: 'Амина - мама двоих детей, стилист',
                instagram: '@amina_khakim',
                aims: [
                    {
                        id: 0,
                        description: 'Комфортного снижения веса при отсутствии тренировок'
                    }
                ],
                extra: null,
                protein: {
                    weight: '65-75',
                    percentage: 33
                },
                fat: {
                    weight: '45-55',
                    percentage: 43
                },
                carbohydrate: {
                    weight: '105-115',
                    percentage: 24
                }
            },
            {
                id: 2,
                imageUrl: '/img/programs/m.png',
                title: 'M',
                kcal: '1450',
                price: 9000,
                iPrice: 10500,
                shortDescription: 'Снижение веса / Поддержание формы',
                isPopular: false,
                instagramLink: 'https://www.instagram.com/savi_fit/',
                bio: 'Валерия - фитнес-тренер групповых программ',
                instagram: '@savi_fit',
                aims: [
                    {
                        id: 0,
                        description: 'Снижения веса при интенсивных тренировках'
                    },
                    {
                        id: 1,
                        description: 'Поддержания формы при отсутствии тренировок'
                    }
                ],
                extra: null,
                protein: {
                    weight: '80-90',
                    percentage: 33
                },
                fat: {
                    weight: '50-60',
                    percentage: 37
                },
                carbohydrate: {
                    weight: '150-160',
                    percentage: 30
                }
            },
            {
                id: 3,
                imageUrl: '/img/programs/l.png',
                title: 'L',
                kcal: '1750',
                price: 10000,
                iPrice: 11500,
                shortDescription: 'Набор массы / Спортивный',
                isPopular: false,
                instagramLink: 'https://www.instagram.com/anna.trener/',
                bio: 'Анна - фитнес-тренер, нутрициолог',
                instagram: '@anna.trener',
                aims: [
                    {
                        id: 0,
                        description: 'Набора массы'
                    }
                ],
                extra: null,
                protein: {
                    weight: '100-110',
                    percentage: 30
                },
                fat: {
                    weight: '75-85',
                    percentage: 33
                },
                carbohydrate: {
                    weight: '180-200',
                    percentage: 37
                }
            }
        ]
    },
    {
        id:1,
        data:[
            {
                id: 0,
                imageUrl: '/img/programs/men_m.png',
                title: 'M',
                kcal: '1450',
                price: 9000,
                iPrice: 10500,
                shortDescription: 'Комфортное снижение веса',
                isPopular: true,
                instagramLink: null,
                bio: 'Берик - ведущий специалист в национальной компании',
                instagram: null,
                aims: [
                    {
                        id: 0,
                        description: 'Комфортного снижения веса при отсутствии физической активности'
                    }
                ],
                extra: null,
                protein: {
                    weight: '80-90',
                    percentage: 33
                },
                fat: {
                    weight: '50-60',
                    percentage: 37
                },
                carbohydrate: {
                    weight: '150-160',
                    percentage: 30
                }
            },
            {
                id: 1,
                imageUrl: '/img/programs/men_l.png',
                title: 'L',
                kcal: '1750',
                price: 10000,
                iPrice: 11500,
                shortDescription: 'Снижение веса / Поддержания формы',
                isPopular: false,
                instagramLink: null,
                bio: 'Арман - предприниматель, регулярно играет в теннис',
                instagram: null,
                aims: [
                    {
                        id: 0,
                        description: 'Комфортного снижения веса при наличии тренировок и активного образа жизни'
                    },
                    {
                        id: 1,
                        description: 'Поддержания формы при отсутствии тренировок и физической активности'
                    }
                ],
                extra: null,
                protein: {
                    weight: '100-110',
                    percentage: 30
                },
                fat: {
                    weight: '75-85',
                    percentage: 33
                },
                carbohydrate: {
                    weight: '180-200',
                    percentage: 37
                }
            },
            {
                id: 2,
                imageUrl: '/img/programs/men_xl.png',
                title: 'XL',
                kcal: '2250',
                price: 10750,
                iPrice: 12250,
                shortDescription: 'Набор массы / Поддержание формы',
                isPopular: false,
                instagramLink: null,
                bio: 'Александр - модель с фотостоков, тренируется в фитнес-клубе',
                instagram: null,
                aims: [
                    {
                        id: 0,
                        description: 'Набора массы'
                    },
                    {
                        id: 1,
                        description: 'Поддержания формы при высокой физической активности'
                    }
                ],
                extra: null,
                protein: {
                    weight: '120-140',
                    percentage: 30
                },
                fat: {
                    weight: '90-100',
                    percentage: 30
                },
                carbohydrate: {
                    weight: '220-240',
                    percentage: 40
                }
            }
        ]
    }
]

export default programs;
