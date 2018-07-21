SELECT
  godown_transfers.id,
  godown_transfers.quantity AS currentQty,
  SUM(f.quantity)           AS sentQty
FROM
  godown_transfers
  LEFT JOIN site_godown_transfers f
    ON godown_transfers.id = f.godown_transfer_id
GROUP BY
  godown_transfers.id
HAVING
  sentQty < godown_transfers.quantity || sentQty IS NULL