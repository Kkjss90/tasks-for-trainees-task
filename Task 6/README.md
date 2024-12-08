# Задача
Написать свой компонент на основе news.list  
1. Компонент должен уметь получать все злементы только по типу инфоблока(без ID конкретного инфоблока)  
2. Если ID инфоблока передан, компонент получает элементы только этого инфоблока(по сути, обычный news.list)  
3. Компонент должен группировать элементы в $arResult['ITEMS'] по ID инфоблоков, из которых они были получены  
4. Компонент должен иметь ООП структуру(вся логика должна быть ревлизована в class.php в виде методов)  
5. (Дополнительно) Добавить поддержку фильтрации по полям. 
6. (Дополнительно) Добавить проверку вводимых параметров и вывод ошибок через ShowError. 