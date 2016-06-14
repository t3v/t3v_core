# Plugin configuration
# ====================

plugin {
  tx_t3vcore {
    settings {
      # ...
    }

    persistence {
      enableAutomaticCacheClearing = 1

      updateReferenceIndex = 0

      # storagePid = {$plugin.tx_t3vcore.persistence.storagePid}
    }

    view {
      layoutRootPath = {$plugin.tx_t3vcore.view.layoutRootPath}

      templateRootPath = {$plugin.tx_t3vcore.view.templateRootPath}

      partialRootPath = {$plugin.tx_t3vcore.view.partialRootPath}
    }
  }
}