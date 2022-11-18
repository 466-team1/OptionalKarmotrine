# OptionalKarmotrine
Sell drinks through a fake webstore.

## SQL Schema

**ORDERS**(<ins>ORDER_NUM</ins>, COST, CUS_NAME, CUS_ADDRESS, CUS_EMAIL, STATUS, NOTE, TRACKING)

**DRINKS**(<ins>NAME</ins>, TYPE, CATEGORY, FLAVOR, PRICE, STOCK)

**HAS**(<ins>ORDER_NUM</ins>&dagger;, <ins>NAME</ins>&dagger;, QTY)
