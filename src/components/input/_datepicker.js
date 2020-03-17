/**
 * Datepicker
 */

import Pikaday from 'pikaday';
import Component from '../../js/lib/component';

export default class Datepicker extends Component {
  init() {
    this.picker = new Pikaday({
      field: this.$.root.get(0),
      position: 'bottom left',
      toString(date) {
        const pad = n => (n < 10 ? `0${n}` : n);
        const day = pad(date.getDate());
        const month = pad(date.getMonth() + 1);
        const year = date.getFullYear();

        return `${day}.${month}.${year}`;
      },
      i18n: {
        previousMonth: 'Предыдущий',
        nextMonth: 'Следующий',
        months: [
          'Январь',
          'Февраль',
          'Март',
          'Апрель',
          'Май',
          'Июнь',
          'Июль',
          'Август',
          'Сентябрь',
          'Октябрь',
          'Ноябрь',
          'Декабрь'
        ],
        weekdays: [
          'Воскресенье',
          'Понедельник',
          'Вторник',
          'Среда',
          'Четверг',
          'Пятница',
          'Суббота'
        ],
        weekdaysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
      }
    });
  }
}

Component.mount(Datepicker, {
  name: 'Datepicker',
  classList: { root: '.js-datepicker' }
});
