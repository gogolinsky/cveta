module.exports = {
  review: {
    1: {
      html:
        '<div class="text"><p>Малыш наипрекраснейший пес. Мягкий, ласковый характер, очень контактный и совсем не злобный. Наверняка он моментально завел бы себе друзей среди наших питомцев. Малыш наипрекраснейший пес. Мягкий, ласковый характер, очень контактный и совсем не злобный. Наверняка он моментально завел бы себе друзей среди наших питомцев</p></div>'
    }
  },
  reviews: {
    html: `
      <li class="reviews__item js-reviews-item">
        <article class="review is-height is-woman"><header class="review__header"><div class="review__avatar"></div><div class="review__info"><h3 class="review__name">Нина Темерязева</h3><div class="review__date"><time class="date" datetime="2018-12-31">18 ноября 2018&nbsp;&nbsp;|&nbsp;&nbsp;16:43</time></div><div class="review__cost"><span class="cost is-big"><span class="cost__value">1 500</span></span></div></div></header></article>
      </li>
      <li class="reviews__item js-reviews-item">
        <article class="review is-medium is-man"><header class="review__header"><div class="review__avatar"></div><div class="review__info"><h3 class="review__name">Юрий Куклачев</h3><div class="review__date"><time class="date" datetime="2018-12-31">18 ноября 2018&nbsp;&nbsp;|&nbsp;&nbsp;16:43</time></div><div class="review__cost"><span class="cost is-big"><span class="cost__value">500</span></span></div></div></header><div class="review__body"><p class="review__text">Малыш наипрекраснейший пес. Мягкий, ласковый характер, очень контактный и совсем не злобный. Наверняка он моментально завел бы себе друзей среди наших питомцев...</p><button class="review__readmore" data-modal-ajax='/review/1'>Читать полностью</button></div></article>
      </li>
      <li class="reviews__item js-reviews-item">
        <article class="review is-low is-woman"><header class="review__header"><div class="review__avatar"></div><div class="review__info"><h3 class="review__name">Мария Зефирина</h3><div class="review__date"><time class="date" datetime="2018-12-31">18 ноября 2018&nbsp;&nbsp;|&nbsp;&nbsp;16:43</time></div><div class="review__cost"><span class="cost is-big"><span class="cost__value">100</span></span></div></div></header><div class="review__body"><p class="review__text">Малыш наипрекраснейший пес. Мягкий, ласковый характер, очень контактный и совсем не злобный. Наверняка он моментально завел бы себе друзей среди наших питомцев...</p><button class="review__readmore" data-modal-ajax='/review/1'>Читать полностью</button></div></article>
      </li>`,
    isLast: true
  },
  service: {
    1: {
      html: `<section class="service-card">
      <div class="service-card__top">
        <div class="container">
          <div class="service-card__bar">
            <button class="service-card__back" data-service-close>Назад к услугам</button>
          </div>
        </div>
      </div>
      <div class="service-card__main">
        <div class="container">
          <div class="grid">
            <div class="col-8 shift-2 col-l-10 shift-l-1 col-md-12 shift-md-0">
              <div class="service-card__content">
                <header class="service-card__header">
                  <p class="service-card__caption">услуги приюта</p>
                  <h2 class="service-card__title">Стерилизация собак и кошек</h2>
                </header>
                <div class="service-card__body">
                  <div class="service-card__text text">
                    <p>Довольно часто возникает вопрос, почему волонтеры с такой строгостью относятся к вопросу стерилизации и кастрации бездомных животных (в том числе тех, кого пристраивают в семью). Дело не только в том, что стерилизация/кастрация – это самый гуманный способ контролировать численность бездомных животных, количество которых сегодня и без того велико. Ветеринары сходятся во мнении, что кастрированные либо стерилизованные животные живут в среднем на 20% дольше, и качество их жизни к старости намного лучше, чем у некастрированных/ нестерилизованных.</p>
                  </div>
                </div>
                <footer class="service-card__footer">
                  <div class="service-card__phone">
                    <div class="phone">
                      <p class="phone__caption">С удовольствием ответим на ваши вопросы</p>
                      <p class="phone__number">8 (905) 160-26-91</p>
                    </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>`
    }
  }
};
